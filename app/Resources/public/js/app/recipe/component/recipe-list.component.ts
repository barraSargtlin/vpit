import {Component} from '@angular/core';
import {Router} from '@angular/router';
import {Recipe} from '../model/recipe';
import {RecipeState} from '../service/recipe.state';

@Component({
    template: `
        <app-recipe-filter></app-recipe-filter>

        <div *ngIf="recipeState.getPageable()|async as recipes"
             class="app-recipe-list">
            <mat-card *ngFor="let recipe of recipes.docs"
                      (click)="onClick(recipe)"
                      class="app-recipe-list__card">
                <mat-card-header>
                    <mat-card-title>{{ recipe.name }}</mat-card-title>
                </mat-card-header>

                <img mat-card-image
                     [src]="getThumbnail(recipe)"
                     [attr.alt]="recipe.name">

                <mat-card-content class="app-recipe-list-card__content">
                    <span>
                        <i *ngIf="recipe.isVegan"
                           class="material-icons">
                            local_florist
                        </i>
                    </span>

                    <span>
                        <i *ngIf="recipe.servings"
                           class="material-icons md-dark">bubble_chart</i>
                        <span>{{ recipe.servings }}</span>
                    </span>

                    <div *ngIf="recipe.hasTime()">
                        <i class="material-icons md-dark">schedule</i>
                        <span>{{ getTime(recipe) }}</span>
                    </div>
                </mat-card-content>
            </mat-card>
        </div>

        <app-pagination></app-pagination>
    `,
})
export class RecipeListComponent {
    constructor(public recipeState: RecipeState,
                private router: Router) {
    }

    public onClick(recipe: Recipe): void {
        const recipeName = recipe.name.replace(' ', '-');

        this.router.navigate(['/recipes', recipe.id, recipeName]);
    }

    public getTime(recipe: Recipe): string {
        if (recipe.preparationTime && recipe.cookTime) {
            return `${recipe.preparationTime} / ${recipe.preparationTime + recipe.cookTime}`;
        }

        return String(recipe.preparationTime || recipe.cookTime);
    }

    public getThumbnail(recipe: Recipe): string {
        return recipe.thumbnail
            ? recipe.thumbnail.path
            : 'http://placehold.it/400x300';
    }
}
