import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RoughDiamondReviewRoutingModule } from './rough-diamond-review-routing.module';
import { RoughDiamondReviewComponent } from './rough-diamond-review.component';
import { SharedUiModule } from 'src/app/shared/ui/shared-ui.module';
import { ReactiveFormsModule } from '@angular/forms';
import { InputTextareaModule } from 'primeng/inputtextarea';
import { SelectButtonModule } from 'primeng/selectbutton';

@NgModule({
  declarations: [RoughDiamondReviewComponent],
  imports: [
    CommonModule,
    RoughDiamondReviewRoutingModule,
    SharedUiModule,
    SelectButtonModule,
    InputTextareaModule,
    ReactiveFormsModule,
  ],
})
export class RoughDiamondReviewModule {}
