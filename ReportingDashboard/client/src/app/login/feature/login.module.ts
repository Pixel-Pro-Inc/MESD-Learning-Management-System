import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { LoginComponent } from './login.component';
import { LoginRoutingModule } from './login-routing.module';
import { ReactiveFormsModule } from '@angular/forms';
import { SharedUiModule } from 'src/app/shared/ui/shared-ui.module';
import { DialogModule } from 'primeng/dialog';
@NgModule({
  declarations: [LoginComponent],
  imports: [
    CommonModule,
    LoginRoutingModule,
    ReactiveFormsModule,
    SharedUiModule,
    DialogModule,
  ],
})
export class LoginModule { }
