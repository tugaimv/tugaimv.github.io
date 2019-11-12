import { Component, OnInit } from '@angular/core';
import {RecipeService} from '../shared/services/recipe.service';
import {ActivatedRoute, Params} from '@angular/router';
import {switchMap} from 'rxjs/operators';

@Component({
  selector: 'app-old-recipe-details-page',
  templateUrl: './old-recipe-details-page.component.html',
  styleUrls: ['./old-recipe-details-page.component.scss']
})
export class OldRecipeDetailsPageComponent implements OnInit {
  oldRecipe;
  id;
  constructor(
    private recipeService: RecipeService,
    private route: ActivatedRoute
  ) { }

  ngOnInit() {
    this.route.queryParams.subscribe( val => {
      this.id = val.parent;
    });
    this.route.params.pipe(
      switchMap( (params: Params) => {
        return this.recipeService.getOldRecipeById(params.id);
      })
    )
      .subscribe( (result) => {
        this.oldRecipe = result.data.oldRecipe;
      });
  }

}
