const express = require('express');
const router = express.Router()
const recipeController = require('../controllers/recipeController');

router
  .route('/')
  .get(recipeController.fetchAll)
  .post(recipeController.createRecipe);

router
  .route('/:id')
  .get(recipeController.getRecipeById)
  .patch(recipeController.updateRecipe)
  .delete(recipeController.removeRecipe);

router
  .route('/old-recipe/:id')
  .get(recipeController.getOldRecipeById);

module.exports = router;
