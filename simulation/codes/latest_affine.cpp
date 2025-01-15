#include <opencv2/opencv.hpp>
#include <iostream>

using namespace std;
using namespace cv;

Mat imtranslate(const Mat& src, int tx, int ty) {
    Mat tmp = Mat::zeros(src.size(), src.type());
    Mat translation_mat = (Mat_<double>(2, 3) << 1, 0, tx, 0, 1, ty);
    warpAffine(src, tmp, translation_mat, tmp.size());
    return tmp;
}

Mat imscale_rotate(const Mat& src, float angl, float scale, int flag) {
    Mat dst;
    Point2f center(src.cols / 2.0, src.rows / 2.0);
    Mat rot_mat = getRotationMatrix2D(center, angl, scale);
    warpAffine(src, dst, rot_mat, src.size(), flag);
    return dst;
}

int main(int argc, char* argv[]) {
    if (argc != 12) {
        cout << "Usage: " << argv[0] << " <input_image> <output_image> <interp> <sc_val> <sc_arg> <angle> <tx> <ty> <o1> <o2> <o3>" << endl;
        return -1;
    }

    Mat src = imread(argv[1]);
    if (src.empty()) {
        cout << "Error loading image " << argv[1] << endl;
        return -1;
    }

    string output = argv[2];
    size_t dot = output.find_last_of(".");
    string img_nm = output.substr(0, dot);
    string img_typ = output.substr(dot + 1);

    int interp = atoi(argv[3]);
    int sc_val = atoi(argv[4]);
    int sc_arg = atoi(argv[5]);
    float scale = sc_arg == 0 ? pow(2, sc_val) : pow(2, -sc_val);
    float angl = atof(argv[6]);
    int tx = atoi(argv[7]);
    int ty = atoi(argv[8]);
    int o1 = atoi(argv[9]);
    int o2 = atoi(argv[10]);
    int o3 = atoi(argv[11]);

    vector<int> flag = {INTER_NEAREST + WARP_FILL_OUTLIERS, INTER_LINEAR + WARP_FILL_OUTLIERS, INTER_CUBIC + WARP_FILL_OUTLIERS};
    vector<int> intrp = {INTER_NEAREST, INTER_LINEAR, INTER_CUBIC};

    Mat tmp, tmp2, dst;
    int opn_cnt = 1;
    char nam[50];

    if (o1 == 1) {
        if (scale == 1)
            tmp = src.clone();
        else {
            resize(src, tmp, Size(), scale, scale, intrp[interp - 1]);
            sprintf(nam, "%s_%d.%s", img_nm.c_str(), opn_cnt++, img_typ.c_str());
            imwrite(nam, tmp);
        }

        if (o2 == 2 && o3 == 3) {
            if (angl == 0)
                tmp2 = tmp.clone();
            else {
                tmp2 = imscale_rotate(tmp, angl, 1, flag[interp - 1]);
                sprintf(nam, "%s_%d.%s", img_nm.c_str(), opn_cnt++, img_typ.c_str());
                imwrite(nam, tmp2);
            }
            if (tx == 0 && ty == 0)
                dst = tmp2.clone();
            else {
                dst = imtranslate(tmp2, tx, ty);
                sprintf(nam, "%s_%d.%s", img_nm.c_str(), opn_cnt++, img_typ.c_str());
                imwrite(nam, dst);
            }
        } else {
            if (tx == 0 && ty == 0)
                tmp2 = tmp.clone();
            else {
                tmp2 = imtranslate(tmp, tx, ty);
                sprintf(nam, "%s_%d.%s", img_nm.c_str(), opn_cnt++, img_typ.c_str());
                imwrite(nam, tmp2);
            }
            if (angl == 0)
                dst = tmp2.clone();
            else {
                dst = imscale_rotate(tmp2, angl, 1, flag[interp - 1]);
                sprintf(nam, "%s_%d.%s", img_nm.c_str(), opn_cnt++, img_typ.c_str());
                imwrite(nam, dst);
            }
        }
    } else if (o2 == 1) {
        if (angl == 0)
            tmp = src.clone();
        else {
            tmp = imscale_rotate(src, angl, 1, flag[interp - 1]);
            sprintf(nam, "%s_%d.%s", img_nm.c_str(), opn_cnt++, img_typ.c_str());
            imwrite(nam, tmp);
        }
        if (o1 == 2 && o3 == 3) {
            if (scale == 1)
                tmp2 = tmp.clone();
            else {
                resize(tmp, tmp2, Size(), scale, scale, intrp[interp - 1]);
                sprintf(nam, "%s_%d.%s", img_nm.c_str(), opn_cnt++, img_typ.c_str());
                imwrite(nam, tmp2);
            }
            if (tx == 0 && ty == 0)
                dst = tmp2.clone();
            else {
                dst = imtranslate(tmp2, tx, ty);
                sprintf(nam, "%s_%d.%s", img_nm.c_str(), opn_cnt++, img_typ.c_str());
                imwrite(nam, dst);
            }
        } else {
            if (tx == 0 && ty == 0)
                tmp2 = tmp.clone();
            else {
                tmp2 = imtranslate(tmp, tx, ty);
                sprintf(nam, "%s_%d.%s", img_nm.c_str(), opn_cnt++, img_typ.c_str());
                imwrite(nam, tmp2);
            }
            if (scale == 1)
                dst = tmp2.clone();
            else {
                resize(tmp2, dst, Size(), scale, scale, intrp[interp - 1]);
                sprintf(nam, "%s_%d.%s", img_nm.c_str(), opn_cnt++, img_typ.c_str());
                imwrite(nam, dst);
            }
        }
    } else if (o3 == 1) {
        if (tx == 0 && ty == 0)
            tmp = src.clone();
        else {
            tmp = imtranslate(src, tx, ty);
            sprintf(nam, "%s_%d.%s", img_nm.c_str(), opn_cnt++, img_typ.c_str());
            imwrite(nam, tmp);
        }
        if (o1 == 2 && o2 == 3) {
            if (scale == 1)
                tmp2 = tmp.clone();
            else {
                resize(tmp, tmp2, Size(), scale, scale, intrp[interp - 1]);
                sprintf(nam, "%s_%d.%s", img_nm.c_str(), opn_cnt++, img_typ.c_str());
                imwrite(nam, tmp2);
            }
            if (angl == 0)
                dst = tmp2.clone();
            else {
                dst = imscale_rotate(tmp2, angl, 1, flag[interp - 1]);
                sprintf(nam, "%s_%d.%s", img_nm.c_str(), opn_cnt++, img_typ.c_str());
                imwrite(nam, dst);
            }
        } else {
            if (angl == 0)
                tmp2 = tmp.clone();
            else {
                tmp2 = imscale_rotate(tmp, angl, 1, flag[interp - 1]);
                sprintf(nam, "%s_%d.%s", img_nm.c_str(), opn_cnt++, img_typ.c_str());
                imwrite(nam, tmp2);
            }
            if (scale == 1)
                dst = tmp2.clone();
            else {
                resize(tmp2, dst, Size(), scale, scale, intrp[interp - 1]);
                sprintf(nam, "%s_%d.%s", img_nm.c_str(), opn_cnt++, img_typ.c_str());
                imwrite(nam, dst);
            }
        }
    }

    sprintf(nam, "%s.%s", img_nm.c_str(), img_typ.c_str());
    imwrite(nam, dst);

    cout << opn_cnt - 1 << endl;
    return opn_cnt - 1;
}
