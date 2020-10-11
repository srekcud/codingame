#include <iostream>
#include <string>
#include <vector>
#include <algorithm>

using namespace std;

/**
 * Auto-generated code below aims at helping you parse
 * the standard input according to the problem statement.
 **/
int main()
{
    int N;
    cin >> N; cin.ignore();

    int horses[N];
    for (int i = 0; i < N; i++) {
        cin >> horses[i]; cin.ignore();
    }

    std::sort(horses,  horses + N);
            // Write an action using Console.WriteLine()
            // To debug: Console.Error.WriteLine("Debug messages...");
            int min = 999;
            for(int i=0; i< N-1; i++){
                int diff = horses[i+1] - horses[i];
                if(diff < min) {
                    min = diff ;
                }
            }

    // Write an action using cout. DON'T FORGET THE "<< endl"
    // To debug: cerr << "Debug messages..." << endl;

    cout << min << endl;
}