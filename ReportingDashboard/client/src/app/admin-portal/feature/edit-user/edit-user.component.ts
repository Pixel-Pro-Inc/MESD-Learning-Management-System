import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { ToastrService } from 'ngx-toastr';
import { BranchDto } from 'src/app/shared/models/branch-dto';
import { BranchRequestDto } from 'src/app/shared/models/branch-request-dto';
import { EditUserDto } from 'src/app/shared/models/edit-user-dto';
import { LocationDto } from 'src/app/shared/models/location-dto';
import { RegisterUserDto } from 'src/app/shared/models/register-user-dto';
import { UserDto } from 'src/app/shared/models/user-dto';
import { AccountService } from 'src/app/shared/services/account-service/account.service';
import { BranchService } from 'src/app/shared/services/branch-service/branch.service';
import { BusyService } from 'src/app/shared/services/busy-service/busy.service';
import { CountryCodeService } from 'src/app/shared/services/country-service/country-code.service';
import { PreferencesService } from 'src/app/shared/services/preferences-service/preferences.service';

@Component({
  selector: 'app-edit-user',
  templateUrl: './edit-user.component.html',
  styleUrls: ['./edit-user.component.css'],
})
export class EditUserComponent implements OnInit {
  constructor(
    private fb: FormBuilder,
    private preferencesService: PreferencesService,
    private countryCodeService: CountryCodeService,
    private accountService: AccountService,
    private toastService: ToastrService,
    private busyService: BusyService
  ) {}

  users: UserDto[] = [];
  userToEdit = null;
  countries: any[];
  permissions = [
    'Administrator',
    'Account Management',
    'Permits',
    'Certificates',
    'Licenses',
    'External',
  ];
  userForm: FormGroup;

  ngOnInit(): void {
    this.initializeForm();

    this.busyService.busy();

    this.countryCodeService.getCountries().then((countries: any[]) => {
      this.countries = countries.filter((element) => element != null);
    });

    this.accountService.getUsers().subscribe(
      (response) => {
        this.users = response;
        this.busyService.idle();
      },
      (error) => {
        this.busyService.idle();
        this.toastService.error(
          'An error has occured please try again and report the issue if it persists.',
          'Error'
        );
      }
    );
  }

  initializeForm() {
    this.userForm = this.fb.group({
      firstname: ['', [Validators.required]],
      lastname: ['', [Validators.required]],
      username: ['', [Validators.required]],
      permissions: ['', [Validators.required]],
      email: ['', [Validators.required, Validators.email]],
      nationalIdentityNumber: ['', [Validators.required]],
      countryCode: ['', Validators.required],
      phoneNumber: ['', Validators.required],
      accountEnabled: ['', Validators.required],
    });
  }

  //loads editForm with necessary data
  edit(user: UserDto) {
    this.userToEdit = user;

    this.userForm.controls.firstname.setValue(user.firstName);
    this.userForm.controls.lastname.setValue(user.lastName);
    this.userForm.controls.username.setValue(user.username);
    this.userForm.controls.permissions.setValue(user.permissions);
    this.userForm.controls.email.setValue(user.email);
    this.userForm.controls.accountEnabled.setValue(user.accountEnabled);

    this.userForm.controls.nationalIdentityNumber.setValue(
      user.nationalIdentityNumber
    );

    //Takes country

    this.userForm.controls.countryCode.setValue(
      this.countries.filter(
        (country) => country.dialingCode == user.phoneNumber.countryCode
      )[0]
    );

    this.userForm.controls.phoneNumber.setValue(user.phoneNumber.number);
  }

  editUser() {
    if (this.userToEdit == null) {
      this.toastService.error('You have to select a user');
      return;
    }

    let editUserDto: EditUserDto = {
      id: this.userToEdit.id,
      firstName: this.userForm.controls.firstname.value,
      lastName: this.userForm.controls.lastname.value,
      username: this.userForm.controls.username.value,
      accountEnabled: this.userForm.controls.accountEnabled.value,
      permissions: this.userForm.controls.permissions.value,
      email: this.userForm.controls.email.value,
      nationalIdentityNumber:
        this.userForm.controls.nationalIdentityNumber.value,
      phoneNumber: {
        countryCode:
          this.userForm.controls.countryCode.value.dialingCode.substring(
            this.userForm.controls.countryCode.value.dialingCode.indexOf('+')
          ),
        number: this.userForm.controls.phoneNumber.value,
      },
    };

    this.busyService.busy();

    this.accountService.editUser(editUserDto).subscribe(
      (response) => {
        this.busyService.idle();
        this.toastService.success('User successfully edited!');
      },
      (error) => {
        this.busyService.idle();
        this.toastService.error(error.error, 'Error');
      }
    );
  }
}
