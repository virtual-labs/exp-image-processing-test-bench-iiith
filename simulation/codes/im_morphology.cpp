#include <iostream>
#include <opencv2/opencv.hpp>

using namespace std;
using namespace cv;

// argv[2] indicates Operation
// argv[3] indicates Shape
// argv[4] indicates Size

int main(int argc, char* argv[])
{
    if (argc != 6) {
        cout << "Usage: " << argv[0] << " <input_image> <output_image> <operation> <shape> <size>" << endl;
        return -1;
    }

    Mat source = imread(argv[1], IMREAD_GRAYSCALE);
    if (source.empty()) {
        cout << "Error loading image " << argv[1] << endl;
        return -1;
    }

    int col = source.cols;
    int row = source.rows;

    Mat dest;
    int operation = atoi(argv[3]);
    int shape = atoi(argv[4]);
    int size = atoi(argv[5]);

    Mat se;

    if (shape == 1) { // Ellipse
        if (size == 1)
            se = getStructuringElement(MORPH_ELLIPSE, Size(3, 3));
        else if (size == 2)
            se = getStructuringElement(MORPH_ELLIPSE, Size(5, 5));
        else if (size == 3)
            se = getStructuringElement(MORPH_ELLIPSE, Size(7, 7));
    } else if (shape == 2) { // Rectangle
        if (size == 1)
            se = getStructuringElement(MORPH_RECT, Size(3, 3));
        else if (size == 2)
            se = getStructuringElement(MORPH_RECT, Size(5, 5));
        else if (size == 3)
            se = getStructuringElement(MORPH_RECT, Size(7, 7));
    } else if (shape == 3) { // Ellipse (duplicate)
        if (size == 1)
            se = getStructuringElement(MORPH_ELLIPSE, Size(3, 3));
        else if (size == 2)
            se = getStructuringElement(MORPH_ELLIPSE, Size(5, 5));
        else if (size == 3)
            se = getStructuringElement(MORPH_ELLIPSE, Size(7, 7));
    }

    if (operation == 1) {
        erode(source, dest, se);
    } else if (operation == 2) {
        dilate(source, dest, se);
    } else if (operation == 3) {
        Mat temp;
        erode(source, temp, se);
        dilate(temp, dest, se);
    } else if (operation == 4) {
        Mat temp;
        dilate(source, temp, se);
        erode(temp, dest, se);
    }

    for (int i = 0; i < row; i++) {
        for (int j = 0; j < col; j++) {
            if (source.at<uchar>(i, j) != dest.at<uchar>(i, j)) {
                cout << (int)source.at<uchar>(i, j) << " and " << (int)dest.at<uchar>(i, j) << endl;
            }
        }
    }

    imwrite(argv[2], dest);

    return 0;
}
