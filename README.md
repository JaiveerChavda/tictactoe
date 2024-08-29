# Real-Time Crosses and Noughts Game

## Description

This is a real-time crosses and noughts game built with Laravel, Vue.js, and Inertia.js, inspired by the Laracasts course ["Real Time Game with Laravel"](https://laracasts.com/series/real-time-games-with-laravel).  The game allows players to create a new game, join existing games, and compete against each other. When a player wins, a modal popup is displayed to announce the winner. 

This project is a perfect showcasing of [Reverb](https://reverb.laravel.com/) and [Echo](https://github.com/laravel/echo), two powerfull tool for real time broadcasting. 
If you're begineer, just starting to learn broadcasing in laravel , follow this projects commit step by step to learn every single feature.I tried to VC every small thing.

## Features

- **Real-Time Gameplay**: Players can create a game and invite others to join, allowing for real-time interaction and gameplay.
- **Player Matchups**: A game starts when a second player joins, enabling head-to-head matches.
- **Winner Announcement**: A modal popup announces the winner at the end of each game.

## Upcoming Features

- **Invite Friends**: Invite friends to join the game via email.
- **Share Scores**: Share your game scores on social media platforms like Twitter and WhatsApp.
- **Real Money Prizes**: Add support for purchasing in-game coins with real money to enable real money prizes for winners.

## Installation

To get started, clone the repository and follow the steps below:

```bash
# Clone the repository
git clone <https://github.com/JaiveerChavda/tictactoe.git>

# Navigate to the project directory
cd tictactoe

# Install dependencies
composer install
npm install

# Run database migrations
php artisan migrate

# Generate app key
php artisan generate:key

# Start the laravel development server
php artisan serve

# Bundle asset/Start hot module replacement 
npm run dev

# Start reverb
php artisan reverb:start

# Listen for queue/Start queue
php artisan queue:work or php artisan queue:listen
npm
```

## Give Feedback 💬

Give your feedback on [@JaiveerChavda](https://x.com/JaiveerChavda)
