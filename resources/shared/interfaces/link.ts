import Tag from '~shared/interfaces/tag';
import {LinkDifficulty} from '~shared/enumes/link-difficulty';
import {LinkType} from '~shared/enumes/link-type';

export default interface Link {
    id: number;
    title: string;
    short_description: string;
    image: string;
    difficulty: LinkDifficulty;
    type: LinkType;
    link: string;
    tags: Tag[],
}