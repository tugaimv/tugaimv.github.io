import {Component, OnDestroy, OnInit} from '@angular/core';
import {RecipeService} from '../shared/services/recipe.service';
import {Subscription} from 'rxjs';


@Component({
  selector: 'app-cookbook-page',
  templateUrl: './cookbook-page.component.html',
  styleUrls: ['./cookbook-page.component.scss']
})
export class CookbookPageComponent implements OnInit, OnDestroy {
  recipes;
  loading = false;
  r1Sub: Subscription;
  constructor(private recipeService: RecipeService) { }

  ngOnInit() {
    this.loading = true;
    this.r1Sub = this.recipeService.fetch().subscribe( data => {
      this.recipes = data.data.recipes;
      this.loading = false;
    });
  }

  ngOnDestroy(): void {
    this.r1Sub.unsubscribe();
  }
}
