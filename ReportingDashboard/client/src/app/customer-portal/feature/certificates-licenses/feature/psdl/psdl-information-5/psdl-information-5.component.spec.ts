import { ComponentFixture, TestBed } from '@angular/core/testing';

import { PsdlInformation5Component } from './psdl-information-5.component';

describe('PsdlInformation5Component', () => {
  let component: PsdlInformation5Component;
  let fixture: ComponentFixture<PsdlInformation5Component>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [PsdlInformation5Component],
    }).compileComponents();

    fixture = TestBed.createComponent(PsdlInformation5Component);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
