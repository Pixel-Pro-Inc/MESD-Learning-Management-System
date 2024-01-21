import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { AccountCreationRoutingModule } from './account-creation-routing.module';
import { AccountCreationComponent } from './account-creation.component';
import { SharedUiModule } from 'src/app/shared/ui/shared-ui.module';
import { MultiSelectModule } from 'primeng/multiselect';
import { ReactiveFormsModule } from '@angular/forms';

@NgModule({
  declarations: [AccountCreationComponent],
  imports: [
    CommonModule,
    AccountCreationRoutingModule,
    SharedUiModule,
    MultiSelectModule,
    ReactiveFormsModule,
  ],
})
export class AccountCreationModule {}
