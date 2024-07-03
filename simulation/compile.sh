export OPENCV_FLAGS=$(pkg-config --cflags --libs opencv4)

g++ codes/latest_affine.cpp $OPENCV_FLAGS -o execs/affine.out
g++ codes/im_point.cpp $OPENCV_FLAGS -o execs/point.out
g++ codes/im_hist.cpp $OPENCV_FLAGS -o execs/hist.out
g++ codes/im_nbrhood.cpp $OPENCV_FLAGS -o execs/neigh.out
g++ codes/im_fourier.cpp $OPENCV_FLAGS -o execs/fourier.out
g++ codes/im_morphology.cpp $OPENCV_FLAGS -o execs/morpho.out
g++ codes/im_segment.cpp $OPENCV_FLAGS -o execs/segment.out
g++ codes/im_colour.cpp $OPENCV_FLAGS -o execs/colour.out 

# cp execs/affine.out ../assignment/execs/affine.out
# cp execs/point.out ../assignment/execs/point.out
# cp execs/hist.out ../assignment/execs/hist.out
# cp execs/neigh.out ../assignment/execs/neigh.out
# cp execs/fourier.out ../assignment/execs/fourier.out
# cp execs/morpho.out ../assignment/execs/morpho.out
# cp execs/segment.out ../assignment/execs/segment.out
# cp execs/colour.out ../assignment/execs/colour.out
