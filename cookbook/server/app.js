const express = require('express');
const recipeRouter = require('./routes/recipeRouter');

const app = express();

app.use(express.json());

app.use('/api/v1/recipes', recipeRouter);

module.exports = app;


