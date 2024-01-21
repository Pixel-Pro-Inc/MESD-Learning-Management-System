import { ComponentFixture, TestBed } from '@angular/core/testing';

import { CountryCodeSelectionComponent } from './country-code-selection.component';

describe('CountryCodeSelectionComponent', () => {
  let component: CountryCodeSelectionComponent;
  let fixture: ComponentFixture<CountryCodeSelectionComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ CountryCodeSelectionComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(CountryCodeSelectionComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
