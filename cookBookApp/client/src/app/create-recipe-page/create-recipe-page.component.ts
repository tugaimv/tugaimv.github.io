import {Component, OnDestroy, OnInit} from '@angular/core';
import {ActivatedRoute, Router} from '@angular/router';
import {FormControl, FormGroup, Validators} from '@angular/forms';
import {RecipeService} from '../shared/services/recipe.service';
import {MaterialService} from '../shared/services/material.service';
import {Subscription} from 'rxjs';

@Component({
  selector: 'app-create-recipe-page',
  templateUrl: './create-recipe-page.component.html',
  styleUrls: ['./create-recipe-page.component.scss']
})
export class CreateRecipePageComponent implements OnInit, OnDestroy {

  new = true;
  form: FormGroup;
  disabled = false;
  recipe;
  loading = false;
  r1Sub: Subscription;
  r2Sub: Subscription;
  r3Sub: Subscription;

  constructor(
    private route: ActivatedRoute,
    private recipeService: RecipeService,
    private router: Router
  ) {
  }

  ngOnInit() {
    this.form = new FormGroup({
      title: new FormControl(null, Validators.required),
      description: new FormControl(null, Validators.required)
    });
    this.route.params.subscribe(param => {
      if (param.id) {
        this.new = false;
        this.loading = true;
        this.recipeService.getRecipeById(param.id).subscribe(response => {
          this.loading = false;
          this.recipe = response.data.recipe;
          this.form.patchValue({
            title: response.data.recipe.title,
            description: response.data.recipe.description
          });
          setTimeout(() => {
            MaterialService.updateTextField();
          }, 0);
        }, err => {
          this.loading = false;
          MaterialService.toast(err);
        });
      }
    });
  }

  ngOnDestroy(): void {
    this.r1Sub.unsubscribe();
    this.r2Sub.unsubscribe();
    this.r3Sub.unsubscribe();
  }

  onSubmit() {
    if (this.form.invalid) {
      return false;
    }
    this.disabled = true;
    this.form.disable();
    const recipe = {
      title: this.form.value.title,
      description: this.form.value.description
    };

    this.r1Sub = this.recipeService.createRecipe(recipe).subscribe( response => {
      this.disabled = false;
      this.form.reset();
      this.form.enable();
      MaterialService.toast('A new recipe was created');
    }, err => {
      this.disabled = false;
      this.form.enable();
      MaterialService.toast(err);
    });
  }

  onEdit() {
    if (this.form.invalid) {
      return false;
    }
    this.disabled = true;
    this.form.disable();
    const newRecipe = {
      title: this.form.value.title,
      description: this.form.value.description,
      createdAt: Date.now()
    };
    this.r2Sub = this.recipeService.updateRecipe(this.recipe._id, newRecipe).subscribe( response => {
      this.disabled = false;
      this.form.enable();
      MaterialService.toast('Recipe edited successfully');
    }, err => {
      this.disabled = false;
      this.form.enable();
      MaterialService.toast(err);
    });
  }

  onRemove() {
    this.disabled = true;
    this.form.disable();
    this.r3Sub = this.recipeService.removeRecipe(this.recipe._id).subscribe( response => {
      this.disabled = false;
      this.form.enable();
      MaterialService.toast('Recipe successfully deleted');
      this.router.navigateByUrl('/');
    }, err => {
      this.disabled = false;
      this.form.enable();
      MaterialService.toast(err);
    });
  }
}
