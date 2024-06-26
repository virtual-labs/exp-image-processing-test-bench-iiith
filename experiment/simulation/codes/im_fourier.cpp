#include <iostream>
#include <opencv2/opencv.hpp>

#define PI 3.1428571
#define MAXI 999999999

void cvShiftDFT(cv::Mat &src, cv::Mat &dst)
{
    cv::Mat tmp, q1, q2, q3, q4, d1, d2, d3, d4;

    int cx = src.cols / 2;
    int cy = src.rows / 2;

    q1 = src(cv::Rect(0, 0, cx, cy));
    q2 = src(cv::Rect(cx, 0, cx, cy));
    q3 = src(cv::Rect(cx, cy, cx, cy));
    q4 = src(cv::Rect(0, cy, cx, cy));

    q1.copyTo(d3);
    q2.copyTo(d4);
    q3.copyTo(d1);
    q4.copyTo(d2);

    d1.copyTo(dst(cv::Rect(0, 0, cx, cy)));
    d2.copyTo(dst(cv::Rect(cx, 0, cx, cy)));
    d3.copyTo(dst(cv::Rect(cx, cy, cx, cy)));
    d4.copyTo(dst(cv::Rect(0, cy, cx, cy)));
}

int main(int argc, char **argv)
{
    if (argc < 2)
    {
        std::cerr << "Usage: " << argv[0] << " <mode> <other args>" << std::endl;
        return -1;
    }

    int mode = atoi(argv[1]);

    if (mode == 1) {
        if (argc < 5) {
            std::cerr << "Usage: " << argv[0] << " 1 <input image> <output mag> <output phase>" << std::endl;
            return -1;
        }

        cv::Mat im = cv::imread(argv[2], cv::IMREAD_GRAYSCALE);
        if (im.empty()) {
            std::cerr << "Error loading image " << argv[2] << std::endl;
            return -1;
        }

        cv::Mat realInput, imaginaryInput, complexInput;
        im.convertTo(realInput, CV_64F);
        imaginaryInput = cv::Mat::zeros(im.size(), CV_64F);
        cv::Mat planes[] = { realInput, imaginaryInput };
        cv::merge(planes, 2, complexInput);

        int dft_M = cv::getOptimalDFTSize(im.rows);
        int dft_N = cv::getOptimalDFTSize(im.cols);

        cv::Mat dft_A;
        cv::copyMakeBorder(complexInput, dft_A, 0, dft_M - im.rows, 0, dft_N - im.cols, cv::BORDER_CONSTANT, cv::Scalar::all(0));

        cv::dft(dft_A, dft_A);

        cv::split(dft_A, planes);
        cv::Mat image_Re = planes[0].clone();
        cv::Mat image_Im = planes[1].clone();
        cv::Mat image_Re2 = planes[0].clone();
        cv::Mat image_Im2 = planes[1].clone();

        cv::magnitude(image_Re, image_Im, image_Re);

        int r = image_Re.rows;
        int c = image_Re.cols;
        for (int i = 0; i < r; ++i) {
            for (int j = 0; j < c; ++j) {
                image_Re2.at<double>(i, j) = atan2(image_Im2.at<double>(i, j), image_Re2.at<double>(i, j));
            }
        }

        image_Re += cv::Scalar::all(1);
        cv::log(image_Re, image_Re);

        cvShiftDFT(image_Re, image_Re);

        double m, M;
        cv::minMaxLoc(image_Re, &m, &M);
        image_Re.convertTo(image_Re, CV_8U, 255.0 / (M - m), -m * 255.0 / (M - m));
        cv::imwrite(argv[3], image_Re);

        cv::minMaxLoc(image_Re2, &m, &M);
        image_Re2.convertTo(image_Re2, CV_8U, 255.0 / (M - m), -m * 255.0 / (M - m));
        cv::imwrite(argv[4], image_Re2);
    }
    else if (mode == 2) {
        if (argc < 5) {
            std::cerr << "Usage: " << argv[0] << " 2 <input mag> <input phase> <output image>" << std::endl;
            return -1;
        }

        cv::Mat magImage = cv::imread(argv[2], cv::IMREAD_GRAYSCALE);
        cv::Mat phaseImage = cv::imread(argv[3], cv::IMREAD_GRAYSCALE);
        if (magImage.empty() || phaseImage.empty()) {
            std::cerr << "Error loading images" << std::endl;
            return -1;
        }

        magImage.convertTo(magImage, CV_64F);
        phaseImage.convertTo(phaseImage, CV_64F);

        // Reverse log transformation
        cv::exp(magImage, magImage);
        magImage -= cv::Scalar::all(1); // Subtract 1 to reverse log domain shift

        // Create complex image from magnitude and phase
        cv::Mat realInput, imaginaryInput;
        cv::polarToCart(magImage, phaseImage, realInput, imaginaryInput);

        cv::Mat complexInput;
        cv::Mat planes[] = { realInput, imaginaryInput };
        cv::merge(planes, 2, complexInput);

        // Perform inverse DFT
        cv::dft(complexInput, complexInput, cv::DFT_INVERSE | cv::DFT_SCALE);

        // Split into planes and take magnitude
        cv::split(complexInput, planes);
        cv::magnitude(planes[0], planes[1], planes[0]);

        // Normalize the output image
        double m, M;
        cv::minMaxLoc(planes[0], &m, &M);
        planes[0].convertTo(planes[0], CV_8U, 255.0 / (M - m), -m * 255.0 / (M - m));
        cv::imwrite(argv[4], planes[0]);
    }
    else if (mode == 3)
    {
        if (argc < 8)
        {
            std::cerr << "Usage: " << argv[0] << " 3 <input image> <output image> <theta> <rad> <deltheta> <delrad>" << std::endl;
            return -1;
        }

        cv::Mat im = cv::imread(argv[2], cv::IMREAD_GRAYSCALE);
        if (im.empty())
        {
            std::cerr << "Error loading image " << argv[2] << std::endl;
            return -1;
        }

        cv::Mat realInput, imaginaryInput, complexInput;
        im.convertTo(realInput, CV_64F);
        imaginaryInput = cv::Mat::zeros(im.size(), CV_64F);
        cv::Mat planes[] = {realInput, imaginaryInput};
        cv::merge(planes, 2, complexInput);

        int theta = atoi(argv[4]);
        int rad = atoi(argv[5]);
        int deltheta = atoi(argv[6]);
        int delrad = atoi(argv[7]);

        double angle1 = theta - (deltheta / 2);
        double angle2 = theta + (deltheta / 2);
        double angle3 = 180 + theta - (deltheta / 2);
        double angle4 = 180 + theta + (deltheta / 2);

        double val1 = atan(tan(PI / 180 * angle1));
        double val2 = atan(tan(PI / 180 * angle2));
        double val3 = atan(tan(PI / 180 * angle3));
        double val4 = atan(tan(PI / 180 * angle4));

        int dft_M = cv::getOptimalDFTSize(im.rows);
        int dft_N = cv::getOptimalDFTSize(im.cols);

        cv::Mat dft_A;
        cv::copyMakeBorder(complexInput, dft_A, 0, dft_M - im.rows, 0, dft_N - im.cols, cv::BORDER_CONSTANT, cv::Scalar::all(0));
        cv::dft(dft_A, dft_A);

        cv::split(dft_A, planes);
        cv::Mat &re = planes[0];
        cv::Mat &imag = planes[1];

        int r = imag.rows;
        int c = imag.cols;
        for (int i = 0; i < r; i++)
        {
            for (int j = 0; j < c; j++)
            {
                double dist = sqrt(pow((i - r / 2), 2) + pow((j - c / 2), 2));
                if ((dist <= rad) && ((rad - delrad) <= dist))
                {
                    double row = i - r / 2;
                    double col = j - c / 2;
                    double val = atan2(row, col);

                    if ((val1 >= val2 && (val >= val1 || val <= val2)) ||
                        (val3 >= val4 && (val >= val3 || val <= val4)) ||
                        (val >= val1 && val <= val2) ||
                        (val >= val3 && val <= val4))
                    {
                        re.at<double>(i, j) = 0.0;
                        imag.at<double>(i, j) = 0.0;
                    }
                }
            }
        }

        cv::merge(planes, 2, dft_A);
        cv::dft(dft_A, dft_A, cv::DFT_INVERSE | cv::DFT_SCALE);

        cv::split(dft_A, planes);
        cv::magnitude(planes[0], planes[1], planes[0]);

        // Normalize without log transform for better contrast control
        double m, M;
        cv::minMaxLoc(planes[0], &m, &M);
        planes[0].convertTo(planes[0], CV_8U, 255.0 / (M - m), -m * 255.0 / (M - m));
        cv::imwrite(argv[3], planes[0]);
    }

    return 0;
}
