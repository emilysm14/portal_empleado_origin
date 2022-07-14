
print ("---------Bienvenidos que comience el juego------")
 
can_fly = True
is_human = True
use_mask = True

if(can_fly): #True
  if(is_human): #True
     if(use_mask) : #True
         print("Ironman")

     else:#No tiene mascara
         print("Cap Marvel")
         
  else:#false
    if(use_mask):
          print("Ronan")
    else :
              print("Vision")
else:
    if(is_human):
       if(use_mask):
           print("Spiderman")
       else :("Hulk")
    else:
        if(use_mask):
            print("Black Bolt")
        else:
            print("Thanos")