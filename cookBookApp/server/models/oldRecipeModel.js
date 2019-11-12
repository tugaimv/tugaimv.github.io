const mongoose = require('mongoose');
const Schema = mongoose.Schema;

const oldRecipeSchema = new Schema({
  title: {
    type: String,
    required: true
  },
  description: {
    type: String,
    required: true
  },
  createdAt: {
    type: Date
  },
  parentId: {
    type: Schema.Types.ObjectId,
    ref: 'Recipe'
  }
});

module.exports = mongoose.model('OldRecipe', oldRecipeSchema);
