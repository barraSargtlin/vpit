import {Component, HostBinding, OnInit} from '@angular/core';
import {ActivatedRoute} from '@angular/router';
import {Observable} from 'rxjs/Observable';
import {slideInDownAnimation} from '../../core/animations';
import {Product} from '../model/product';
import {ProductState} from '../service/product.state';

@Component({
    animations: [slideInDownAnimation],
    template: `
        <product-form [product]="product|async">
        </product-form>
    `,
})
export class ProductDetailComponent implements OnInit {
    @HostBinding('@routeAnimation') public routeAnimation = true;
    @HostBinding('style.display') public display = 'block';
    @HostBinding('style.position') public position = 'absolute';
    public product: Observable<Product | undefined>;

    constructor(private productState: ProductState,
                private route: ActivatedRoute) {
    }

    public ngOnInit(): void {
        this.product = this.route.params
            .switchMap((params) => {
                return !isNaN(params.id)
                    ? this.productState.getProduct(+params.id)
                    : Observable.of(undefined);
            });
    }
}
