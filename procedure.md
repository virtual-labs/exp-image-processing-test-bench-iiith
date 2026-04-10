In general, a good strategy to solve a given problem is the 'divide and conquer' approach. This involves breaking the problem into smaller sub-problems, solving each one, and combining the solutions.

In this experiment, you are provided with an environment to build a solution to a problem by combining solutions to several sub-problems. The system you build will function as a cascade of different modules, each solving a part of the problem.

The goal of this test bench is to help you experiment with and understand how algorithms are constructed.

**Part 1: Sequential Image Processing**

1. **Start with a mosaic image:**
- Select an image from the provided mosaic.
- Apply different operations on the image in a serial fashion.
2. **Example Workflow:**
- First, apply **contrast stretching** to enhance the image.
- Save the resulting image and use it as input for the next operation, such as **filtering** (neighborhood processing).
- Finally, perform **segmentation** using thresholding.
3. **Using Piping Functionality:**
- To use the output image from one step as the input for the next, click the button labeled **"Return to piping".**
- When prompted with **"Retain changes?"**, click **OK** to proceed.
4. **Experiment with Order of Operations:**
- For complex workflows, analyze how changing the sequence of steps impacts the final result.

**Part 2: Design and Implement Your Algorithm**
1. **Define a Specific Task:**
- Identify a specific image processing problem you’d like to solve.
2. **Design an Algorithm:**
- Outline the steps required to solve your task on paper.
3. **Implement Using the Test Bench:**
- Use the test bench environment to implement your algorithm.
- Test and refine the steps as needed to achieve the desired outcome.

**Tip:** Refer to the **Assessment Section** for sample problems to practice and explore.