import java.util.*;
import java.io.*;
import java.math.*;

/**
 * Auto-generated code below aims at helping you parse
 * the standard input according to the problem statement.
 **/
class Solution {

    public static void main(String args[]) {
        Scanner in = new Scanner(System.in);
        int N = in.nextInt();

        int[] horses = new int[N];
        for (int i = 0; i < N; i++) {
            horses[i]=in.nextInt();
        }

        Arrays.sort(horses);

         int min = 999;
        for(int i=0; i< N-1; i++){
            int diff = horses[i+1] - horses[i];
            if(diff < min) {
                min = diff ;
            }
        }
        // Write an action using System.out.println()
        // To debug: System.err.println("Debug messages...");

        System.out.println(min);
    }
}