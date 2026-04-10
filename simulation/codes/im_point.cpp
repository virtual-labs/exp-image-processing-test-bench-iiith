#include <iostream>
#include <opencv2/opencv.hpp>
#include <cmath>

using namespace std;
using namespace cv;

Mat Log_Image(const Mat& src, int cn)
{
    Mat final_img = Mat::zeros(src.size(), src.type());
    for (int i = 0; i < src.rows; i++)
    {
        for (int j = 0; j < src.cols; j++)
        {
            int grval = src.at<uchar>(i, j);
            grval = cn * log10(1 + grval);
            grval = clamp(grval, 0, 255);
            final_img.at<uchar>(i, j) = grval;
        }
    }
    return final_img;
}

Mat Contrast_Stretch(const Mat& src, float a, float b)
{
    Mat final_img = Mat::zeros(src.size(), src.type());
    for (int i = 0; i < src.rows; i++)
    {
        for (int j = 0; j < src.cols; j++)
        {
            int grval = static_cast<int>(tan(a * M_PI / 180) * src.at<uchar>(i, j) + b);
            grval = clamp(grval, 0, 255);
            final_img.at<uchar>(i, j) = grval;
        }
    }
    return final_img;
}

Mat Clipped_Image(const Mat& src, float a, float b, float beta)
{
    Mat final_img = Mat::zeros(src.size(), src.type());
    for (int i = 0; i < src.rows; i++)
    {
        for (int j = 0; j < src.cols; j++)
        {
            int grval = src.at<uchar>(i, j);
            if (grval < a)
                grval = 0;
            else if (grval > b)
                grval = 255;
            else
                grval = static_cast<int>(beta * grval);
            grval = clamp(grval, 0, 255);
            final_img.at<uchar>(i, j) = grval;
        }
    }
    return final_img;
}

Mat Windowed_Image(const Mat& src, float a, float b, float beta)
{
    Mat final_img = Mat::zeros(src.size(), src.type());
    for (int i = 0; i < src.rows; i++)
    {
        for (int j = 0; j < src.cols; j++)
        {
            int grval = src.at<uchar>(i, j);
            if (grval < a || grval > b)
                grval = 0;
            else
                grval = static_cast<int>(beta * grval);
            grval = clamp(grval, 0, 255);
            final_img.at<uchar>(i, j) = grval;
        }
    }
    return final_img;
}

int main(int argc, char *argv[])
{
    if (argc < 4) {
        cout << "Usage: " << argv[0] << " <input_image> <output_image> <operation> [additional_params...]" << endl;
        return -1;
    }

    Mat src = imread(argv[1], IMREAD_GRAYSCALE);
    if (src.empty()) {
        cout << "Error loading image " << argv[1] << endl;
        return -1;
    }

    Mat dst;
    int operation = atoi(argv[3]);

    switch (operation)
    {
    case 1:
        if (argc != 6) {
            cout << "Usage for contrast stretch: " << argv[0] << " <input_image> <output_image> 1 <a> <b>" << endl;
            return -1;
        }
        dst = Contrast_Stretch(src, atof(argv[4]), atof(argv[5]));
        break;

    case 2:
        if (argc != 5) {
            cout << "Usage for log image: " << argv[0] << " <input_image> <output_image> 2 <c>" << endl;
            return -1;
        }
        dst = Log_Image(src, atoi(argv[4]));
        break;

    case 3:
        if (argc != 7) {
            cout << "Usage for clipped image: " << argv[0] << " <input_image> <output_image> 3 <a> <b> <beta>" << endl;
            return -1;
        }
        dst = Clipped_Image(src, atof(argv[4]), atof(argv[5]), atof(argv[6]));
        break;

    case 4:
        if (argc != 7) {
            cout << "Usage for windowed image: " << argv[0] << " <input_image> <output_image> 4 <a> <b> <slope>" << endl;
            return -1;
        }
        dst = Windowed_Image(src, atof(argv[4]), atof(argv[5]), atof(argv[6]));
        break;

    default:
        cout << "Invalid operation" << endl;
        return -1;
    }

    imwrite(argv[2], dst);
    return 0;
}
