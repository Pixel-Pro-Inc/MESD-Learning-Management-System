import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { DclReviewRoutingModule } from './dcl-review-routing.module';
import { DclReviewComponent } from './dcl-review.component';
import { ReactiveFormsModule } from '@angular/forms';
import { DropdownModule } from 'primeng/dropdown';
import { InputTextareaModule } from 'primeng/inputtextarea';
import { SelectButtonModule } from 'primeng/selectbutton';
import { DataGridModule } from 'src/app/admin-portal/ui/data-grid/data-grid.module';
import { SharedUiModule } from 'src/app/shared/ui/shared-ui.module';

@NgModule({
  declarations: [DclReviewComponent],
  imports: [
    CommonModule,
    DclReviewRoutingModule,
    DataGridModule,
    SelectButtonModule,
    SharedUiModule,
    InputTextareaModule,
    DropdownModule,
    ReactiveFormsModule,
  ],
})
export class DclReviewModule {}
