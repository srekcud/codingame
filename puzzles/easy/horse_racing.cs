using System;
using System.Linq;
using System.IO;
using System.Text;
using System.Collections;
using System.Collections.Generic;

/**
 * Auto-generated code below aims at helping you parse
 * the standard input according to the problem statement.
 **/
class Solution
{
    static void Main(string[] args)
    {
        int N = int.Parse(Console.ReadLine());
        int[] horses = new int[N];
        for (int i = 0; i < N; i++)
        {
            horses[i] = int.Parse(Console.ReadLine());
        }
        Array.Sort(horses);
        // Write an action using Console.WriteLine()
        // To debug: Console.Error.WriteLine("Debug messages...");
        int min = 999;
        for(int i=0; i< N-1; i++){
            int diff = horses[i+1] - horses[i];
            if(diff < min) {
                min = diff ;
            }
        }
        Console.WriteLine(min);
    }
}