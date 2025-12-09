import turtle
import time

# Screen setup
screen = turtle.Screen()
screen.title("Ball Animation")
screen.bgcolor("black")
screen.setup(width=800, height=600)

# Ball setup
ball = turtle.Turtle()
ball.shape("circle")
ball.color("cyan")
ball.penup()
ball.speed(0)

# Movement speed
ball.dx = 4
ball.dy = 4

while True:
    screen.update()

    # Move ball
    ball.setx(ball.xcor() + ball.dx)
    ball.sety(ball.ycor() + ball.dy)

    # Bounce from walls
    if ball.xcor() > 380 or ball.xcor() < -380:
        ball.dx *= -1

    if ball.ycor() > 280 or ball.ycor() < -280:
        ball.dy *= -1

    time.sleep(0.01)
