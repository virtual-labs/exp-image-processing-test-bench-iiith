#include <opencv2/opencv.hpp>
#include <iostream>
#include <vector>
#include <algorithm>

using namespace std;
using namespace cv;

float global_sum = 0;
int parm;

Mat linear(Mat &img, float arr[][7])
{
	int c = img.cols;
	int r = img.rows;

	Mat final_img = Mat::zeros(img.size(), img.type());
	for (int xp = 0; xp < r; xp++)
	{
		for (int yp = 0; yp < c; yp++)
		{
			double val = 0;
			for (int i = 0; i < parm; i++)
			{
				for (int j = 0; j < parm; j++)
				{
					int x = xp - (parm / 2) + i;
					int y = yp - (parm / 2) + j;
					if (x >= 0 && x < r && y >= 0 && y < c)
					{
						val += arr[i][j] * static_cast<float>(img.at<uchar>(x, y));
					}
				}
			}
			if (global_sum != 0)
				final_img.at<uchar>(xp, yp) = saturate_cast<uchar>(val / global_sum);
			else
				final_img.at<uchar>(xp, yp) = saturate_cast<uchar>(val);
		}
	}
	return final_img;
}

Mat medn_filt(Mat &img)
{
	int c = img.cols;
	int r = img.rows;

	Mat final_img = Mat::zeros(img.size(), img.type());
	for (int xp = 0; xp < r; xp++)
	{
		for (int yp = 0; yp < c; yp++)
		{
			vector<int> grvals;
			for (int i = 0; i < parm; i++)
			{
				for (int j = 0; j < parm; j++)
				{
					int x = xp - (parm / 2) + i;
					int y = yp - (parm / 2) + j;
					if (x >= 0 && x < r && y >= 0 && y < c)
					{
						grvals.push_back(img.at<uchar>(x, y));
					}
				}
			}
			sort(grvals.begin(), grvals.end());
			if (grvals.size() % 2 == 0)
				final_img.at<uchar>(xp, yp) = saturate_cast<uchar>(0.5 * (grvals[grvals.size() / 2 - 1] + grvals[grvals.size() / 2]));
			else
				final_img.at<uchar>(xp, yp) = grvals[grvals.size() / 2];
		}
	}
	return final_img;
}

void UnsharpMasking(Mat &src, const char *out_img)
{
	Mat UnsharpMaskingImage = src.clone();
	Mat temp1, temp2;

	GaussianBlur(src, temp1, Size(27, 27), 0);
	subtract(src, temp1, temp2);

	temp2 *= 1.5;
	add(temp2, src, UnsharpMaskingImage);

	imwrite("smoothened.jpg", temp1);
	imwrite("subtracted.jpg", temp2);
	imwrite(out_img, UnsharpMaskingImage);
}

int main(int argc, char *argv[])
{
	if (argc < 4)
	{
		cout << "Usage: " << argv[0] << " <input_image> <output_image> <operation> [params]" << endl;
		return -1;
	}

	char *img_nm = argv[1];
	Mat img1 = imread(img_nm, IMREAD_GRAYSCALE);

	if (img1.empty())
	{
		cout << "Error: Cannot load image " << img_nm << endl;
		return -1;
	}

	float arr[7][7];
	parm = atoi(argv[3]);

	if (parm == 6)
	{
		UnsharpMasking(img1, argv[2]);
	}
	else
	{
		Mat nbrd_img;
		if (parm == 2)
		{
			parm = atoi(argv[4]);
			nbrd_img = medn_filt(img1);
		}
		else
		{
			for (int i = 0; i < parm; i++)
			{
				for (int j = 0; j < parm; j++)
				{
					arr[i][j] = atof(argv[i * parm + j + 4]);
					global_sum += arr[i][j];
				}
			}
			nbrd_img = linear(img1, arr);
		}
		imwrite(argv[2], nbrd_img);
	}

	return 0;
}
