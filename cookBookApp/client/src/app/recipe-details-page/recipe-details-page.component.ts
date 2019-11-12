import {Component, OnDestroy, OnInit} from '@angular/core';
import {RecipeService} from '../shared/services/recipe.service';
import {ActivatedRoute, Params} from '@angular/router';
import {switchMap} from 'rxjs/operators';
import {Subscription} from 'rxjs';


@Component({
  selector: 'app-recipe-details-page',
  templateUrl: './recipe-details-page.component.html',
  styleUrls: ['./recipe-details-page.component.scss']
})
export class RecipeDetailsPageComponent implements OnInit, OnDestroy {
  recipe;
  oldRecipes;
  rSub: Subscription;
  constructor(
    private recipeService: RecipeService,
    private route: ActivatedRoute
  ) { }

  ngOnInit() {
    this.rSub = this.route.params.pipe(
      switchMap( (params: Params) => {
        return this.recipeService.getRecipeById(params.id);
      })
    )
      .subscribe( (result) => {
        this.recipe = result.data.recipe;
        this.oldRecipes = result.data.oldRecipes;
      });
  }
  ngOnDestroy(): void {
    this.rSub.unsubscribe();
  }
}
