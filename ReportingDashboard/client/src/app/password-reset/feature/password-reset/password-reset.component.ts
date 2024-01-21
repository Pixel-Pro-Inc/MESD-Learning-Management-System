import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { ToastrService } from 'ngx-toastr';
import { PasswordResetDto } from 'src/app/shared/models/password-reset-dto';
import { AccountService } from 'src/app/shared/services/account-service/account.service';
import { BusyService } from 'src/app/shared/services/busy-service/busy.service';

@Component({
  selector: 'app-password-reset',
  templateUrl: './password-reset.component.html',
  styleUrls: ['./password-reset.component.css'],
})
export class PasswordResetComponent implements OnInit {
  constructor(
    private fb: FormBuilder,
    private route: ActivatedRoute,
    private accountService: AccountService,
    private toastService: ToastrService,
    private busyService: BusyService,
    private routerService: Router
  ) {
    this.route.queryParams.subscribe((params) => {
      this.accountID = params['accountID'];
    });
  }

  accountID: string;
  resetForm: FormGroup;

  ngOnInit(): void {
    this.initializeForm();
  }

  initializeForm() {
    this.resetForm = this.fb.group({
      token: ['', [Validators.required]],
      password: ['', [Validators.required]],
    });
  }

  reset() {
    this.busyService.busy();

    let passwordResetDto: PasswordResetDto = {
      accountID: this.accountID,
      token: this.resetForm.controls.token.value,
      password: this.resetForm.controls.password.value,
    };

    this.accountService.passwordReset(passwordResetDto).subscribe(
      (response) => {
        this.busyService.idle();

        this.routerService.navigateByUrl('/sign-in');
      },
      (error) => {
        this.busyService.idle();
        this.toastService.error(error.error);
      }
    );
  }
}
