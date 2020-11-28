# Zanichelli

Is always funny to demostrate how systems can be stupid.


# Usage

1. Open "Developer Tools" (Ctrl + Shift + I on Chrome)
2. Go to the network section
3. Start the test
4. Search for a request having the url starting with `https://zte.zanichelli.it/viewer-be/api/homework/zte_` and click on it
5. Open the `Response` tab
6. Copy the content of the response in `sources`
7. Run the command below, by default won't show the questions but only the answers, use `questions` to change this.

       php main.php [questions]
8. Enjoy your mark :P

# Credits

[Dametto Luca](https://damettoluca.com)  
[ShiSHcat](https://shishc.at)
