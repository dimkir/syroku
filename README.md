# syroku
Simple Symfony template to run on Heroku


To use simply clone the repository to directory which will become your project root

`git clone https://github.com/dimkir/syroku.git my-project`

And after create new heroku project with this command

```
heroku apps:create my-project
```

Set heroku settings with:

```
bin/heroku-initial-setup.sh
```
This command will set up correct buidlpacks and some enviornment variables


Now if you want to set up a database, you have to set another variable:


And now push the project to heroku:

```
git push heroku master
```
