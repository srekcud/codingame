
import sys
import math

# Auto-generated code below aims at helping you parse
# the standard input according to the problem statement.
horses = []
min = 100000000000000;
n = int(input())
for i in range(n):
    horses.append(int(input()))

horses.sort()

for i in range(n-1):
    diff = horses[i + 1] - horses[i]
    if diff < min :
        min = diff


# Write an action using print
# To debug: print("Debug messages...", file=sys.stderr)

print(min)
