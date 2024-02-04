import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
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
    private routerService: Router
  ) {}

  loginForm: FormGroup;

  ngOnInit(): void {
    this.initializeForm();

    var video = document.querySelector('video');
    video.muted = true;
    video.play();
  }

  initializeForm() {
    this.loginForm = this.fb.group({
      username: ['', [Validators.required]],
      password: ['', [Validators.required]],
    });
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

        this.routerService.navigateByUrl('/report-portal');
      },
      (error) => {
        this.busyService.idle();
        this.toastService.error(error.error);
      }
    );
  }
}
