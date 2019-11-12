import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import {LayoutComponent} from './shared/layout/layout.component';
import {CookbookPageComponent} from './cookbook-page/cookbook-page.component';
import {CreateRecipePageComponent} from './create-recipe-page/create-recipe-page.component';
import {RecipeDetailsPageComponent} from './recipe-details-page/recipe-details-page.component';
import {OldRecipeDetailsPageComponent} from './old-recipe-details-page/old-recipe-details-page.component';


const routes: Routes = [
  {
    path: '', component: LayoutComponent, children: [
      {path: '', component: CookbookPageComponent},
      {path: 'recipe/new', component: CreateRecipePageComponent},
      {path: 'recipe/:id', component: RecipeDetailsPageComponent},
      {path: 'recipe/edit/:id', component: CreateRecipePageComponent},
      {path: 'old-recipe/:id', component: OldRecipeDetailsPageComponent}
    ]
  }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
