import {ChangeDetectionStrategy, Component} from '@angular/core';
import {PageableState} from '../../shared/model/pageable.state';
import {FilterState} from '../../shared/service/filter.state';
import {ProductState} from '../service/product.state';

@Component({
    changeDetection: ChangeDetectionStrategy.OnPush,
    providers: [
        FilterState,
        ProductState,
        {provide: PageableState, useExisting: ProductState},
    ],
    template: `
        <router-outlet></router-outlet>
    `,
})
export class ProductComponent {
}
