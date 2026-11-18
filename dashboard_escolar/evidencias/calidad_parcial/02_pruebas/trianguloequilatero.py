#moddifica este codigo para que aparezca el triangulo y un cuadro

import turtle 

tortuga = turtle.Turtle()

tortuga.speed(1)
tortuga.pencolor("red")
tortuga.pensize(5)
tortuga.fillcolor("yelllow")

tortuga.begin_fill()
#genera el ciclo para el triangulo equilatero
for i in range(3):
    tortuga.forward(100)
    tortuga.left(120)
    
tortuga.end_fill()
    
turtle.done()
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    