# BwnRaids
The Devils Backbone: Raiding Application

[Demo](https://bwnraids.excit.no)

## Installation

0. Create a user on GitHub and ask to become a collaborator.
1. Install Git: https://git-scm.com/downloads
2. Install a PHP engine, 7.x.x+ http://php.net
3. Clone the Git Repository, by typing: `git clone https://github.com/GauteR/BwnRaids.git` in the folder you want the project installed.
3. Install composer: https://getcomposer.org/doc/00-intro.md
4. Install packages: https://getcomposer.org/doc/01-basic-usage.md by typing `composer install` (If this does not work, add composer and php to your PATH variables and restart commandline)
5. Run `php yii serve` in the folder where your installation is. This will start a development server. You can also use any other web server to host the application.

## Making changes

1. Run `git pull` to fetch the latest updates.
2. Create a new branch, if you haven't already: `git branch dev-yourname`. Skip this step if you have created a branch already. This is done so that we can easily merge changes from everyone into the master code.
3. Checkout your branch: `git checkout dev-yourname`. 
4. When finished editing run `git add .` to add modified files to the repository.
5. Run `git commit -m "Message"` to commit the modified files to the repository, add a sensible message too. If it's tied to an issue, add #00 (issue number) - to link the message to an issue.
6. Run `git push` to send all the data to the remote repository so that others can look at your changes.

### Other stuff
* Read the GitHub guide: https://guides.github.com/activities/hello-world/