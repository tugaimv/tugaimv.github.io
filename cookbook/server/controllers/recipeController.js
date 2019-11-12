const Recipe = require('../models/recipeModel');
const OldRecipe = require('../models/oldRecipeModel');

exports.fetchAll = async (req, res) => {
  try {
    const recipes = await Recipe.find().sort({createdAt: -1});
    res.status(200).json({
      status: 'success',
      results: recipes.length,
      data: {
        recipes
      }
    });
  } catch(err) {
    res.status(404).json({
      status: 'fail',
      message: 'Recipes not found!'
    });
  }
};

exports.getRecipeById = async (req, res) => {
  try {
    const recipe = await Recipe.findById(req.params.id);
    const oldRecipes = await OldRecipe.find({parentId: req.params.id}).sort({createdAt: -1});
    res.status(200).json({
      status: 'success',
      data: {
        recipe,
        oldRecipes
      }
    });
  } catch (err) {
    res.status(404).json({
      status: 'fail',
      message: 'Recipe not found'
    });
  }
};

exports.createRecipe = async (req, res) => {
  try {
    const newRecipe = await Recipe.create(req.body);
    res.status(200).json({
      status: 'success',
      data: {
        recipe: newRecipe
      }
    });
  } catch (err) {
   res.status(400).json({
     status: 'fail',
     message: 'Invalid data send!'
   });
  }
};

exports.updateRecipe = async (req, res) => {
  try {
    const oldRecipe = await Recipe.findById(req.params.id);

    const copy = JSON.parse(JSON.stringify(oldRecipe));
    copy.parentId = oldRecipe._id
    delete copy._id;
    await OldRecipe.create(copy);

    const recipe = await Recipe.findByIdAndUpdate(req.params.id, req.body, {
      new: true,
      runValidators: true
    });

    res.status(200).json({
      status: 'success',
      data: {
        recipe
      }
    });
  } catch (err) {
    res.status(409).json({
      status: 'fail',
      message: err
    });
  }
};

exports.removeRecipe = async (req, res) => {
  try {
    await Recipe.findByIdAndDelete(req.params.id);
    await OldRecipe.remove({parentId: req.params.id});
    res.status(204).json({
      status: 'success',
      data: null
    });
  } catch (err) {
    res.status(404).json({
      status: 'fail',
      message: err
    });
  }
};

exports.getOldRecipeById = async (req, res) => {
  try {
    const oldRecipe = await OldRecipe.findById(req.params.id)
    res.status(200).json({
      status: 'success',
      data: {
        oldRecipe
      }
    });
  } catch (err) {
    res.status(404).json({
      status: 'fail',
      message: 'Recipe not found'
    });
  }
};
