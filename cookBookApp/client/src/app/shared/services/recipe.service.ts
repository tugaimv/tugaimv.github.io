import {Injectable} from '@angular/core';
import {HttpClient} from '@angular/common/http';
import {Response} from '../interfaces/interfaces';
import {Observable} from 'rxjs';


@Injectable({providedIn: 'root'})
export class RecipeService {
  constructor( private http: HttpClient) {}
  fetch(): Observable<Response> {
    return this.http.get<Response>(`/api/v1/recipes`);
  }
  getRecipeById(id): Observable<Response> {
    return this.http.get<Response>(`/api/v1/recipes/${id}`);
  }
  createRecipe(recipe): Observable<Response> {
    return this.http.post<Response>(`/api/v1/recipes`, recipe);
  }
  updateRecipe(id, recipe): Observable<Response> {
    return this.http.patch<Response>(`/api/v1/recipes/${id}`, recipe);
  }
  removeRecipe(id): Observable<Response> {
    return this.http.delete<Response>(`/api/v1/recipes/${id}`);
  }
  getOldRecipeById(id): Observable<Response> {
    return this.http.get<Response>(`/api/v1/recipes/old-recipe/${id}`);
  }
}
