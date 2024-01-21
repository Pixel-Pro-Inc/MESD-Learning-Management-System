import { Component, OnInit, Renderer2 } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { ToastrService } from 'ngx-toastr';
import { BranchDto } from 'src/app/shared/models/branch-dto';
import { EditBranchDto } from 'src/app/shared/models/edit-branch-dto';
import { LocationDto } from 'src/app/shared/models/location-dto';
import { SetThemeDto } from 'src/app/shared/models/set-theme-dto';
import { BranchService } from 'src/app/shared/services/branch-service/branch.service';
import { BusyService } from 'src/app/shared/services/busy-service/busy.service';
import { CountryCodeService } from 'src/app/shared/services/country-service/country-code.service';
import { PreferencesService } from 'src/app/shared/services/preferences-service/preferences.service';
import { ThemeService } from 'src/app/shared/services/theme-service/theme.service';

@Component({
  selector: 'app-settings',
  templateUrl: './settings.component.html',
  styleUrls: ['./settings.component.css'],
})
export class SettingsComponent implements OnInit {
  constructor(
    private fb: FormBuilder,
    private preferencesService: PreferencesService,
    private countryCodeService: CountryCodeService,
    private branchService: BranchService,
    private themeService: ThemeService,
    private toastService: ToastrService,
    private busyService: BusyService,
    private renderer: Renderer2
  ) {}

  countries: any[] = [];
  logo: string;
  logoName: string;
  favIcon: string;
  branch: BranchDto;
  branchForm: FormGroup;
  branchLocation: LocationDto;
  themeForm: FormGroup;
  location: any;

  ngOnInit(): void {
    this.initializeForm();

    this.countryCodeService.getCountries().then((countries: any[]) => {
      this.countries = countries.filter((element) => element != null);
    });
  }

  initializeForm() {
    this.branchForm = this.fb.group({
      branchId: [''],
      name: ['', [Validators.required]],
      shortName: ['', [Validators.required, Validators.maxLength(11)]],
      phoneNumber1: ['', [Validators.required, Validators.minLength(7)]],
      phoneNumber2: ['', [Validators.minLength(7)]],
      currency: ['', Validators.required],
      timeZone: ['', Validators.required],
      countryCode1: [''],
      countryCode2: [''],
      minimumDeliveryAmount: ['', Validators.required],
      minimumCardPaymentAmount: ['', Validators.required],
      deliveryRadius: ['', Validators.required],
      mondayOpening: ['', Validators.required],
      tuesdayOpening: ['', Validators.required],
      wednesdayOpening: ['', Validators.required],
      thursdayOpening: ['', Validators.required],
      fridayOpening: ['', Validators.required],
      saturdayOpening: ['', Validators.required],
      sundayOpening: ['', Validators.required],
      publicOpening: ['', Validators.required],
      mondayClosing: ['', Validators.required],
      tuesdayClosing: ['', Validators.required],
      wednesdayClosing: ['', Validators.required],
      thursdayClosing: ['', Validators.required],
      fridayClosing: ['', Validators.required],
      saturdayClosing: ['', Validators.required],
      sundayClosing: ['', Validators.required],
      publicClosing: ['', Validators.required],
    });

    this.branchService
      .getBranch({
        branchId: this.preferencesService.getPreferences().branchId,
        locationDto: null,
      })
      .subscribe(
        (response) => {
          this.branch = response;
          this.location = {
            lat: response.location.latitude,
            lng: response.location.longitude,
          };
          this.branchForm.controls.branchId.setValue(response.branchId);
          this.branchForm.controls.name.setValue(response.name);
          this.branchForm.controls.shortName.setValue(response.shortName);
          this.branchForm.controls.phoneNumber1.setValue(
            response.phoneNumbers.length > 0
              ? response.phoneNumbers[0].number
              : ''
          );
          this.branchForm.controls.phoneNumber2.setValue(
            response.phoneNumbers.length > 1
              ? response.phoneNumbers[1].number
              : ''
          );
          this.branchForm.controls.currency.setValue(response.currency);
          this.branchForm.controls.timeZone.setValue(response.timeZone);
          this.branchForm.controls.minimumDeliveryAmount.setValue(
            response.minimumDeliveryAmount
          );
          this.branchForm.controls.minimumCardPaymentAmount.setValue(
            response.minimumCardPaymentAmount
          );
          this.branchForm.controls.deliveryRadius.setValue(
            response.deliveryRadius
          );
          this.branchForm.controls.mondayOpening.setValue(
            response.openingTimes[0]
          );
          this.branchForm.controls.tuesdayOpening.setValue(
            response.openingTimes[1]
          );
          this.branchForm.controls.wednesdayOpening.setValue(
            response.openingTimes[2]
          );
          this.branchForm.controls.thursdayOpening.setValue(
            response.openingTimes[3]
          );
          this.branchForm.controls.fridayOpening.setValue(
            response.openingTimes[4]
          );
          this.branchForm.controls.saturdayOpening.setValue(
            response.openingTimes[5]
          );
          this.branchForm.controls.sundayOpening.setValue(
            response.openingTimes[6]
          );
          this.branchForm.controls.publicOpening.setValue(
            response.openingTimes[7]
          );
          this.branchForm.controls.mondayClosing.setValue(
            response.closingTimes[0]
          );
          this.branchForm.controls.tuesdayClosing.setValue(
            response.closingTimes[1]
          );
          this.branchForm.controls.wednesdayClosing.setValue(
            response.closingTimes[2]
          );
          this.branchForm.controls.thursdayClosing.setValue(
            response.closingTimes[3]
          );
          this.branchForm.controls.fridayClosing.setValue(
            response.closingTimes[4]
          );
          this.branchForm.controls.saturdayClosing.setValue(
            response.closingTimes[5]
          );
          this.branchForm.controls.sundayClosing.setValue(
            response.closingTimes[6]
          );
          this.branchForm.controls.publicClosing.setValue(
            response.closingTimes[7]
          );
        },
        (error) => {
          this.toastService.error(
            'An error has occured please try again and report the issue if it persists.',
            'Error'
          );
        }
      );

    this.themeForm = this.fb.group({
      logo: [''],
      logoPublicId: [''],
      logoName: [''],
      logoNamePublicId: [''],
      favIcon: [''],
      favIconPublicId: [''],
      windowTitle: ['My Awesome Restaurant', [Validators.required]],
      lightColor: ['#ffffff', [Validators.required]],
      linkColor: ['#007bff', [Validators.required]],
      accentColor: ['#cc0000', [Validators.required]],
      secondaryColor: ['#007ecc', [Validators.required]],
      grayColor: ['#919aa3', [Validators.required]],
      lightGrayColor: ['#e5e5e5', [Validators.required]],
      lightestGrayColor: ['#ededed', [Validators.required]],
      mediumGrayColor: ['#606060', [Validators.required]],
      darkGrayColor: ['#444444', [Validators.required]],
      darkestGrayColor: ['#292929', [Validators.required]],
    });

    if (this.themeService.cachedTheme != null) {
      this.themeForm.setValue(this.themeService.cachedTheme);
    }
  }

  onFileChangeLogo(event) {
    const reader = new FileReader();

    if (event.target.files && event.target.files.length) {
      const [file] = event.target.files;
      reader.readAsDataURL(file);

      reader.onload = () => {
        this.logo = reader.result as string;
      };
    }
  }

  onFileChangeLogoName(event) {
    const reader = new FileReader();

    if (event.target.files && event.target.files.length) {
      const [file] = event.target.files;
      reader.readAsDataURL(file);

      reader.onload = () => {
        this.logoName = reader.result as string;
      };
    }
  }

  onFileChangeFavIcon(event) {
    const reader = new FileReader();

    if (event.target.files && event.target.files.length) {
      const [file] = event.target.files;
      reader.readAsDataURL(file);

      reader.onload = () => {
        this.favIcon = reader.result as string;
      };
    }
  }

  public locationSelected(location: any) {
    this.branchLocation = {
      latitude: location.latitude,
      longitude: location.longitude,
      physicalAddress: location.address,
      index: 0,
      defaultZoomLevel: 14,
      addressName: '',
      extraAddressInfo: '',
      countryCode: '',
    };
  }

  convertToDate(timeString: string) {
    const timeParts = timeString.split(':');
    const dateObject = new Date();
    dateObject.setHours(parseInt(timeParts[0], 10));
    dateObject.setMinutes(parseInt(timeParts[1], 10));

    return dateObject;
  }

  setTheme() {
    let setThemeDto: SetThemeDto = this.themeForm.value;

    setThemeDto.logo = this.logo;
    setThemeDto.logoName = this.logoName;
    setThemeDto.favIcon = this.favIcon;

    this.busyService.busy();

    this.themeService.setTheme(setThemeDto).subscribe(
      (response) => {
        if (response == null) {
          return;
        }

        this.themeService.applyTheme(response, this.renderer, document);

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

  updateBranch() {
    let openingTimes: Date[] = [];
    let closingTimes: Date[] = [];

    let array = [
      this.branchForm.controls.mondayOpening.value,
      this.branchForm.controls.tuesdayOpening.value,
      this.branchForm.controls.wednesdayOpening.value,
      this.branchForm.controls.thursdayOpening.value,
      this.branchForm.controls.fridayOpening.value,
      this.branchForm.controls.saturdayOpening.value,
      this.branchForm.controls.sundayOpening.value,
      this.branchForm.controls.publicOpening.value,
    ];

    array.forEach((element) => {
      openingTimes.push(this.convertToDate(element));
    });

    array = [
      this.branchForm.controls.mondayClosing.value,
      this.branchForm.controls.tuesdayClosing.value,
      this.branchForm.controls.wednesdayClosing.value,
      this.branchForm.controls.thursdayClosing.value,
      this.branchForm.controls.fridayClosing.value,
      this.branchForm.controls.saturdayClosing.value,
      this.branchForm.controls.sundayClosing.value,
      this.branchForm.controls.publicClosing.value,
    ];

    array.forEach((element) => {
      closingTimes.push(this.convertToDate(element));
    });

    this.branchLocation.addressName = this.branchForm.controls.name.value;

    this.branchLocation.countryCode = this.countries.filter(
      (element) =>
        element.dialingCode ==
        this.branchForm.controls.countryCode1.value.dialingCode
    )[0].name;

    let editBranchDto: EditBranchDto = {
      branchId: this.branchForm.controls.branchId.value,
      name: this.branchForm.controls.name.value,
      shortName: this.branchForm.controls.shortName.value,
      phoneNumbers: [
        {
          countryCode:
            this.branchForm.controls.countryCode1.value.dialingCode.substring(
              this.branchForm.controls.countryCode1.value.dialingCode.indexOf(
                '+'
              )
            ),
          number: this.branchForm.controls.phoneNumber1.value,
        },
        {
          countryCode:
            this.branchForm.controls.countryCode2.value.dialingCode.substring(
              this.branchForm.controls.countryCode2.value.dialingCode.indexOf(
                '+'
              )
            ),
          number: this.branchForm.controls.phoneNumber2.value,
        },
      ],
      currency: this.branchForm.controls.currency.value,
      timeZone: this.branchForm.controls.timeZone.value,
      openingTimes: openingTimes,
      closingTimes: closingTimes,
      minimumDeliveryAmount:
        this.branchForm.controls.minimumDeliveryAmount.value,
      minimumCardPaymentAmount:
        this.branchForm.controls.minimumCardPaymentAmount.value,
      deliveryRadius: this.branchForm.controls.deliveryRadius.value,
      location: this.branchLocation,
    };

    this.busyService.busy();

    this.branchService.editBranch(editBranchDto).subscribe(
      (response) => {
        this.busyService.idle();
        this.toastService.success('Branch successfully edited!');
      },
      (error) => {
        this.busyService.idle();
        this.toastService.error(error.error, 'Error');
      }
    );
  }
}
