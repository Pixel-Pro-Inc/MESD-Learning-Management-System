import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { ToastrService } from 'ngx-toastr';
import { Preferences } from 'src/app/shared/models/preferences';
import { RegisterUserDto } from 'src/app/shared/models/register-user-dto';
import { AccountService } from 'src/app/shared/services/account-service/account.service';
import { BusyService } from 'src/app/shared/services/busy-service/busy.service';
import { PreferencesService } from 'src/app/shared/services/preferences-service/preferences.service';

@Component({
  selector: 'app-sign-up',
  templateUrl: './sign-up.component.html',
  styleUrls: ['./sign-up.component.css'],
})
export class SignUpComponent implements OnInit {
  constructor(
    private fb: FormBuilder,
    private accountService: AccountService,
    private toastService: ToastrService,
    private busyService: BusyService,
    private preferencesService: PreferencesService,
    private routerService: Router
  ) {}

  countries: any[];
  permissions = [
    'Billing',
    'Administrative',
    'Kitchen',
    'Cashier',
    'Delivery',
    'Development',
  ];
  userForm: FormGroup;

  ngOnInit(): void {
    this.initializeForm();

    var video = document.querySelector('video');
    video.muted = true;
    video.play();
  }

  initializeForm() {
    this.userForm = this.fb.group({
      firstname: ['', [Validators.required]],
      lastname: ['', [Validators.required]],
      username: ['', [Validators.required]],
      email: ['', [Validators.required, Validators.email]],
      nationalIdentityNumber: ['', [Validators.required]],
      password: ['', [Validators.required]],
      countryCode: ['', Validators.required],
      phoneNumber: ['', Validators.required],
    });
  }

  registerUser() {
    let registerUserDto: RegisterUserDto = {
      firstname: this.userForm.controls.firstname.value,
      lastname: this.userForm.controls.lastname.value,
      username: this.userForm.controls.username.value,
      permissions: ['External'],
      email: this.userForm.controls.email.value,
      nationalIdentityNumber:
        this.userForm.controls.nationalIdentityNumber.value,
      password: this.userForm.controls.password.value,
      phoneNumber: {
        countryCode:
          this.userForm.controls.countryCode.value.dialingCode.substring(
            this.userForm.controls.countryCode.value.dialingCode.indexOf('+')
          ),
        number: this.userForm.controls.phoneNumber.value,
      },
    };

    this.busyService.busy();

    let prefs: Preferences = this.preferencesService.getPreferences();

    this.accountService.registerUser(registerUserDto).subscribe(
      (response) => {
        this.busyService.idle();
        this.toastService.success(
          'We have successfully registered your account!'
        );

        prefs.user = response;

        this.preferencesService.setPreferences(prefs);

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
        this.toastService.error(error.error, 'Error');
      }
    );
  }
}
