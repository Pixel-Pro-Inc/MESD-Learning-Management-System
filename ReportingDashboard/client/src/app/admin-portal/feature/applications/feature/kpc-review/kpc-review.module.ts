import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { KpcReviewComponent } from './kpc-review.component';
import { KpcReviewRoutingModule } from './kpc-review-routing.module';
import { ReactiveFormsModule } from '@angular/forms';
import { DropdownModule } from 'primeng/dropdown';
import { InputTextareaModule } from 'primeng/inputtextarea';
import { SelectButtonModule } from 'primeng/selectbutton';
import { DataGridModule } from 'src/app/admin-portal/ui/data-grid/data-grid.module';
import { SharedUiModule } from 'src/app/shared/ui/shared-ui.module';

@NgModule({
  declarations: [KpcReviewComponent],
  imports: [
    CommonModule,
    KpcReviewRoutingModule,
    DataGridModule,
    SelectButtonModule,
    SharedUiModule,
    InputTextareaModule,
    DropdownModule,
    ReactiveFormsModule,
  ],
})
export class KpcReviewModule {}
