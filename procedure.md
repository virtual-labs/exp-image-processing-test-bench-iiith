In general, a good strategy to solve a given problem is the 'divide and conquer' approach. This involves breaking the problem into smaller sub-problems, solving each one, and combining the solutions.

In this experiment, you are provided with an environment to build a solution to a problem by combining solutions to several sub-problems. The system you build will function as a cascade of different modules, each solving a part of the problem.

The goal of this test bench is to help you experiment with and understand how algorithms are constructed.

**Sequential Image Processing (Pipeline)**

1. **Select the starting image:**
    - Choose a mosaic (**Standard**, **Segmentation**, **Morphology** or **Colour**) from the list above the mosaic.
    - Drag (or touch-drag) over the mosaic to select a region. It becomes stage 0 of the pipeline.
2. **Add a processing step:**
    - Choose a module: colour → single channel, point operation, arithmetic / combine, affine transformation, histogram equalization, neighbourhood filter, Fourier spectrum, morphological operation or segmentation.
    - A region from the **Colour** mosaic stays in colour. Convert it with **Colour → single channel** first, because the other modules work on gray images.
    - Set its parameters and click **Preview Step** to see the result in the Step Output panel.
    - Click **Add to Pipeline** to keep the step. Its output becomes the input of the next step.
3. **Example workflow:**
    - First, apply **contrast stretching** (point operation) to enhance the image.
    - Next, apply **filtering** (neighbourhood filter) to the enhanced image.
    - Finally, perform **segmentation** using thresholding.
4. **Combine stages:**
    - Use **Arithmetic / combine** to bring in the original image or the output of an earlier step, for example **Cut out** the original image where a segmentation mask is white.
5. **Experiment with the order of operations:**
    - Each step in the pipeline shows its intermediate result. Use the **↑ / ↓** buttons to change the order, **Edit** to change a step's parameters, or **✕** to remove it; the pipeline re-runs from the start.
    - Analyse how changing the sequence of steps impacts the final result.
6. **Finish:**
    - Click **Finish** to see the final result with the list of steps and questions to evaluate it.
    - Use **Copy Steps** and **Download Result** to record your solution, then **Start a New Pipeline** (or **Reset**) to begin again.

**Tip:** Click **Load Example** to see a complete worked pipeline (extracting the Taj Mahal), and refer to the **Assessment** section for problems to solve, including designing your own algorithm.
