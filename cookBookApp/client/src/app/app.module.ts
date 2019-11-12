import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { LayoutComponent } from './shared/layout/layout.component';
import { CookbookPageComponent } from './cookbook-page/cookbook-page.component';
import { RecipeCardComponent } from './shared/components/recipe-card/recipe-card.component';
import { CreateRecipePageComponent } from './create-recipe-page/create-recipe-page.component';
import { RecipeDetailsPageComponent } from './recipe-details-page/recipe-details-page.component';
import {FormsModule, ReactiveFormsModule} from '@angular/forms';
import {HttpClientModule} from '@angular/common/http';
import { PreloaderComponent } from './shared/components/preloader/preloader.component';
import { OldRecipeDetailsPageComponent } from './old-recipe-details-page/old-recipe-details-page.component';

@NgModule({
  declarations: [
    AppComponent,
    LayoutComponent,
    CookbookPageComponent,
    RecipeCardComponent,
    CreateRecipePageComponent,
    RecipeDetailsPageComponent,
    PreloaderComponent,
    OldRecipeDetailsPageComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    FormsModule,
    ReactiveFormsModule,
    HttpClientModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
