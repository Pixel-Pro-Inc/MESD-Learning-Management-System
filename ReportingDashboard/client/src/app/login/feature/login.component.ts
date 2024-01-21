import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { ToastrService } from 'ngx-toastr';
import { LoginDto } from 'src/app/shared/models/login-dto';
import { Preferences } from 'src/app/shared/models/preferences';
import { AccountService } from 'src/app/shared/services/account-service/account.service';
import { BusyService } from 'src/app/shared/services/busy-service/busy.service';
import { PreferencesService } from 'src/app/shared/services/preferences-service/preferences.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css'],
})
export class LoginComponent implements OnInit {
  constructor(
    private fb: FormBuilder,
    private accountService: AccountService,
    private preferencesService: PreferencesService,
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

    let prefs: Preferences = this.preferencesService.getPreferences();

    this.accountService.login(loginDto).subscribe(
      (response) => {
        this.busyService.idle();
        prefs.user = response;

        this.preferencesService.setPreferences(prefs);

        if (prefs.user.permissions.includes('Administrator')) {
          this.routerService.navigateByUrl('/admin-portal/dashboard');
          return;
        }

        if (prefs.nextPage) {
          this.routerService.navigateByUrl(prefs.nextPage);
          prefs.nextPage = null;
          this.preferencesService.setPreferences(prefs);
          return;
        }

        this.routerService.navigateByUrl('/');
      },
      (error) => {
        this.busyService.idle();
        this.toastService.error(error.error);
      }
    );
  }
}
