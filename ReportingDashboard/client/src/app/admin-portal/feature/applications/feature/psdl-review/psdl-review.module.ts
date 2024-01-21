import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { PsdlReviewRoutingModule } from './psdl-review-routing.module';
import { PsdlReviewComponent } from './psdl-review.component';
import { DataGridModule } from 'src/app/admin-portal/ui/data-grid/data-grid.module';
import { SelectButtonModule } from 'primeng/selectbutton';
import { SharedUiModule } from 'src/app/shared/ui/shared-ui.module';
import { InputTextareaModule } from 'primeng/inputtextarea';
import { DropdownModule } from 'primeng/dropdown';
import { ReactiveFormsModule } from '@angular/forms';

@NgModule({
  declarations: [PsdlReviewComponent],
  imports: [
    CommonModule,
    PsdlReviewRoutingModule,
    DataGridModule,
    SelectButtonModule,
    SharedUiModule,
    InputTextareaModule,
    DropdownModule,
    ReactiveFormsModule,
  ],
})
export class PsdlReviewModule {}
