import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RegisterDiamondsRoutingModule } from './register-diamonds-routing.module';
import { ReactiveFormsModule } from '@angular/forms';
import { SharedUiModule } from 'src/app/shared/ui/shared-ui.module';
import { RegisterDiamondsComponent } from './register-diamonds.component';
import { DropdownModule } from 'primeng/dropdown';

@NgModule({
  declarations: [RegisterDiamondsComponent],
  imports: [
    CommonModule,
    RegisterDiamondsRoutingModule,
    ReactiveFormsModule,
    DropdownModule,
    SharedUiModule,
  ],
})
export class RegisterDiamondsModule {}
