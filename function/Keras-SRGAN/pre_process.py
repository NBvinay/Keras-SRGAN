from PIL import Image
import cv2
from scipy.misc import imresize

image=cv2.imread('./data_lr/input_image.jpg')
newImg = imresize(image, (96,96) , interp = 'bicubic', mode = None)
cv2.imwrite('./data_lr/input_image.jpg',newImg)



