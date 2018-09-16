import { Component, Prop, Vue } from 'vue-property-decorator';

@Component
export default class ContactComponent extends Vue
{
    @Prop() private msg!: string;
}
