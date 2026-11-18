import turtle 

tortuga = turtle.Turtle()

tortuga.speed(1)
tortuga.pencolor("red")
tortuga.pensize(5)
tortuga.fillcolor("yellow")


tortuga.begin_fill()
for i in range(3):
    tortuga.forward(100)
    tortuga.left(120)
tortuga.end_fill()


tortuga.penup()
tortuga.forward(150) 
tortuga.pendown()


tortuga.begin_fill()
for i in range(4):
    tortuga.forward(100)
    tortuga.left(90)
tortuga.end_fill()
    
turtle.done()