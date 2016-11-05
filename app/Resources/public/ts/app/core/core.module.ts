import {CommonModule} from "@angular/common";
import {NgModule} from '@angular/core';
import {FlashMessageComponent} from "./component/flash-message.component";
import {RoutingService} from "./service/routing.service";
import {FlashMessageService} from "./service/flash-message.service";
import {TranslationService} from "./service/translation.service";

@NgModule({
    imports: [
        CommonModule,
    ],
    declarations: [
        FlashMessageComponent,
    ],
    exports: [
        FlashMessageComponent,
    ],
    providers: [
        FlashMessageService,
        RoutingService,
        TranslationService,
    ]
})
export class CoreModule {}