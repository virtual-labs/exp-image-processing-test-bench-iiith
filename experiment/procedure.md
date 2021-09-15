In general, a good strategy to solve a given problem is using a ¡®divide and conquer¡¯ approach. Here the problem is broken down into sub-problems and solved. In this experiment, you are provided with an environment which will allow you to build a solution to a problem by stringing together the solution to several sub-problems. Thus, the system you build is a cascade of different modules.

This test bench is meant to help you experiment and learn how algorithms are built.

Part1: For a start, take your select an image from the mosaic and try applying different operations on it in a serial fashion.

Example: Apply contrast stretching first, save the image and use that as input image for the next steps which could be filtering (neighbourhood processing) followed by segmentation by thresholding.

To use the output image of a processing step as input image for the next step, click on the button ¡°Return to piping¡±. This will prompt you with ¡°Retain changes?¡± Click ¡®OK¡±.

If you have a long sequence of steps first understand the effect of swapping the order of steps on the processed result.

Part 2: Now try defining a specific task for yourself and solve it by designing an algorithm for the same on paper and implementing it using the test bench. Some sample problems are given in the assessment section.