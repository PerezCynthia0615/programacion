import turtle


pantalla = turtle.Screen()
pantalla.bgcolor("skyblue")

tortuga = turtle.Turtle()
tortuga.speed(3)
tortuga.pensize(2)


tortuga.penup()
tortuga.goto(-200, -100)
tortuga.pendown()

tortuga.pencolor("black")
tortuga.fillcolor("powderblue")
tortuga.begin_fill()
for i in range(4):
    tortuga.forward(120)
    tortuga.left(90)
tortuga.end_fill()


tortuga.penup()
tortuga.goto(-200, 20)
tortuga.pendown()

tortuga.fillcolor("brown")
tortuga.begin_fill()
for i in range(3):
    tortuga.forward(120)
    tortuga.left(120)
tortuga.end_fill()


tortuga.penup()
tortuga.goto(-160, -100)
tortuga.pendown()

tortuga.fillcolor("saddlebrown")
tortuga.begin_fill()
for i in range(2):
    tortuga.forward(40)
    tortuga.left(90)
    tortuga.forward(60)
    tortuga.left(90)
tortuga.end_fill()


tortuga.penup()
tortuga.goto(-115, -30)
tortuga.pendown()

tortuga.fillcolor("yellow")
tortuga.begin_fill()
for i in range(4):
    tortuga.forward(25)
    tortuga.left(90)
tortuga.end_fill()



tortuga.penup()
tortuga.goto(80, -100)
tortuga.pendown()

tortuga.fillcolor("sienna")
tortuga.begin_fill()
for i in range(2):
    tortuga.forward(30)
    tortuga.left(90)
    tortuga.forward(50)
    tortuga.left(90)
tortuga.end_fill()


tortuga.penup()
tortuga.goto(45, -50)
tortuga.pendown()

tortuga.fillcolor("lightgreen")
tortuga.begin_fill()
for i in range(3):
    tortuga.forward(100)
    tortuga.left(120)
tortuga.end_fill()


tortuga.penup()
tortuga.goto(55, 20)
tortuga.pendown()

tortuga.fillcolor("darkgreen")
tortuga.begin_fill()
for i in range(3):
    tortuga.forward(80)
    tortuga.left(120)
tortuga.end_fill()


tortuga.hideturtle()
turtle.done()