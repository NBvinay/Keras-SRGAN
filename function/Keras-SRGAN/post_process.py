import numpy as np
import cv2
from matplotlib import pyplot as plt

img = cv2.imread('./output/sr_image.jpg')

dst = cv2.fastNlMeansDenoisingColored(img,None,5,5,7,21)

cv2.imwrite('./output/sr_image_smooth.jpg',dst)