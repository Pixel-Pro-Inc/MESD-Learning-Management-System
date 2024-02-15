import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { ToastrService } from 'ngx-toastr';
import { LoginDto } from 'src/app/shared/models/login-dto';
import { AccountService } from 'src/app/shared/services/account-service/account.service';
import { BusyService } from 'src/app/shared/services/busy-service/busy.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css'],
})
export class LoginComponent implements OnInit {
  constructor(
    private fb: FormBuilder,
    private accountService: AccountService,
    private toastService: ToastrService,
    private busyService: BusyService,
    private routerService: Router,
    private route: ActivatedRoute

  ) {
    this.route.queryParams.subscribe(params => {
      let token = params['token'];
      if (token) {
        this.sso(token);
      }
    });
  }

  loginForm: FormGroup;
  otpForm: FormGroup;
  otpVisible = false;

  ngOnInit(): void {
    this.initializeForm();
  }

  initializeForm() {
    this.loginForm = this.fb.group({
      username: ['', [Validators.required]],
      password: ['', [Validators.required]],
    });

    this.otpForm = this.fb.group({
      otp: ['', [Validators.required]],
    });
  }

  sso(token) {
    this.busyService.busy();

    this.accountService.sso(token).subscribe(
      (response) => {
        this.busyService.idle();
        //Store user
        localStorage.setItem('user', JSON.stringify(response));
        //Navigate to reports
        this.routerService.navigateByUrl('/report-portal');
      },
      (error) => {
        this.busyService.idle();
        this.toastService.error(error.error);
      }
    );
  }

  login() {
    let loginDto: LoginDto = {
      username: this.loginForm.controls.username.value,
      password: this.loginForm.controls.password.value,
    };

    this.busyService.busy();

    this.accountService.login(loginDto).subscribe(
      (response) => {
        this.busyService.idle();
        //SHOW OTP FORM
        this.otpVisible = true;

        this.toastService.success('Welcome Back');
      },
      (error) => {
        this.busyService.idle();
        this.toastService.error(error.error);
      }
    );
  }

  otp() {
    let otpDto = {
      username: this.loginForm.controls.username.value,
      otp: this.otpForm.controls.otp.value,
    };

    this.busyService.busy();

    this.accountService.otp(otpDto).subscribe(
      (response) => {
        this.busyService.idle();
        //Store user
        localStorage.setItem('user', JSON.stringify(response));
        //Navigate to reports
        this.routerService.navigateByUrl('/report-portal');
      },
      (error) => {
        this.busyService.idle();
        this.toastService.error(error.error);
      }
    );
  }
}
