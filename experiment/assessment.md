Use the tools and techniques provided in the test bench to complete the following image processing tasks. Each task names the mosaic to choose in the simulation (**Standard**, **Segmentation** or **Colour**) and the grid position of the image in that mosaic.

1. **Bush Region Extraction**
   - Extract the image regions corresponding to the bushes (the trimmed hedges and trees along the path) from the image located at **Standard mosaic, Grid: (Row 3, Column 2).**
2. **Leaf Region Extraction**
   - Extract the image regions corresponding to the leaves of the flower in the image located at **Segmentation mosaic, Grid: (Row 1, Column 1).**
   - **Hint:** Use point operations to normalize the leaf brightness, followed by segmentation to isolate the leaves.
3. **Non-English Text Extraction**
   - Extract the words written in non-English text from the image located at **Standard mosaic, Grid: (Row 1, Column 1).**
4. **Tiger Whiskers Extraction**
   - Extract the tiger's whiskers from the image located at **Standard mosaic, Grid: (Row 3, Column 3).**
5. **Taj Mahal Extraction (worked example)**
   - Extract the Taj Mahal monument from the image located at **Standard mosaic, Grid: (Row 3, Column 2).**
   - Click **Load Example** in the simulation to see one complete solution. Study each step, then try to improve it, for example by changing the region-growing tolerance or the morphological operation.
6. **Colour Object Extraction**
   - Extract the yellow rose, in colour, from the image located at **Colour mosaic, Grid: (Row 2, Column 3).**
   - **Hint:** Start with **Colour → single channel** and find the channel in which the yellow rose stands out from the red rose and the leaves.
7. **Design and Implement Your Own Algorithm**
   - **Define a task:** choose an image from any mosaic and identify a specific image processing problem you would like to solve.
   - **Design an algorithm:** outline on paper the sequence of steps you expect to need.
   - **Implement it in the test bench:** build the steps as a pipeline, examine the intermediate results, and refine the order or parameters until you reach the desired outcome.
   - **Report:** compare your final pipeline with your paper design and explain any changes you had to make.

**Recording your solution**

- Build your solution as a sequence of steps with **Add to Pipeline**, and examine each intermediate result.
- Use **Arithmetic / combine → Cut out** to keep only the extracted region of the original image.
- Click **Finish** to review the result against the evaluation questions, then use **Copy Steps** to copy the list of steps and **Download Result** to save the final image.
