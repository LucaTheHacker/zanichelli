# Zanichelli

It's always funny to demonstrate how systems can be stupid.

# Usage

1. Open "Developer Tools" (Ctrl + Shift + I on Chrome)
2. Go to the network section
3. Start the test
4. Search for a request having the url starting with `https://zte.zanichelli.it/viewer-be/api/homework/zte_` and click on it
5. Open the `Response` tab
6. Copy the content of the response in `sources`
7. Run the command below, by default it won't show the questions, but only answers. Use `questions` to change this.

       php main.php [questions]
8. Enjoy your mark :P

# Advanced usage

You can find all the methods in the class file `zanichelli.php`, they are well documented and also simple to understand by reading the code, because the Zanichelli security sucks.
Have a great time reading infos (also emails of the creators) and passing all the tests with maximum marks.
For Zanichelli, base64 doesn't protect you.

# Credits

[Dametto Luca](https://damettoluca.com)  
[ShiSHcat](https://shishc.at)
